<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\StoreDiscountVoucher;

use App\DiscountVoucher;

use App\Options\DiscountVoucherStatusOptions;

use App\Services\ImageService;

class DiscountVoucherController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Process uploaded image as needed and move to a correct location.
     * @param  \App\Services\ImageService              $imageService
     * @param  \App\Http\Requests\StoreDiscountVoucher $request
     * @return string                                  Image file name
     */
    private function processImage(&$imageService, &$request) {
        $originalExtension = $request->file('image')->getClientOriginalExtension();
        $fileName = $imageService->generateUniqueFileName('discount_voucher_image_', $originalExtension);

        $imageService->process($request->file('image')->getRealPath(), null, $fileName, 800);

        return $fileName;
    }

    /**
     * Display a listing of vouchers.
     * @param  App\Options\DiscountVoucherStatusOptions $statusOptions Discount Voucher status options
     * @return \Illuminate\Http\Response
     */
    public function index(DiscountVoucherStatusOptions $statusOptions)
    {
        return view('discount_vouchers/index')->with([
            'statusOptions' => $statusOptions->options(),
            'vouchers' => DiscountVoucher::orderBy('created_at', 'asc')->get(),
        ]);
    }

    /**
     * Shows form for creating a new voucher.
     * @param  App\Options\DiscountVoucherStatusOptions $statusOptions Discount Voucher status options
     * @return \Illuminate\Http\Response
     */
    public function create(DiscountVoucherStatusOptions $statusOptions)
    {
        $this->authorize('create', DiscountVoucher::class);

        return view('discount_vouchers/create')->with([
            'statusOptions' => $statusOptions->options(),
        ]);
    }

    /**
     * Store new voucher in the database.
     * @param  App\Http\Requests\StoreDiscountVoucher $request      Request
     * @param  App\Services\ImageService              $imageService Image service
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscountVoucher $request, ImageService $imageService)
    {
        $voucher = new DiscountVoucher;

        $voucher->title = $request->title;
        $voucher->description = $request->description;
        $voucher->duration = (int) $request->duration;
        $voucher->status = (boolean) $request->status;

        if ( $request->hasFile('image') )
        {
            $fileName = $this->processImage($imageService, $request);
            $voucher->image = $fileName;
        }

        $voucher->save();

        return redirect()->route('discount_voucher.index');
    }

    /**
     * Shows form for editing an existing voucher.
     * @param  App\DiscountVoucher                      $voucher       Discount Voucher object
     * @param  App\Options\DiscountVoucherStatusOptions $statusOptions Discount Voucher status options
     * @return \Illuminate\Http\Response
     */
    public function edit(DiscountVoucher $voucher, DiscountVoucherStatusOptions $statusOptions)
    {
        $this->authorize('update', $voucher);

        return view('discount_vouchers/edit')->with([
            'statusOptions' => $statusOptions->options(),
            'voucher' => $voucher,
        ]);
    }

    /**
     * Update existing voucher in the database.
     * @param  App\Http\Requests\StoreDiscountVoucher $request      Request
     * @param  App\DiscountVoucher                    $voucher      Voucher object
     * @param  App\Services\ImageService              $imageService Image service
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDiscountVoucher $request, DiscountVoucher $voucher, ImageService $imageService)
    {
        $voucher->title = $request->title;
        $voucher->description = $request->description;
        $voucher->duration = (int) $request->duration;
        $voucher->status = (boolean) $request->status;

        if ( $request->hasFile('image') ) {
            $voucher->deleteImage();

            $voucher->image = $this->processImage($imageService, $request);
        }

        $voucher->save();

        return redirect()->route('discount_voucher.index', [ '#' . $voucher->id ]);
    }

    /**
     * Remove voucher from the database and delete uploaded image from storage.
     * @param  App\DiscountVoucher $voucher Voucher object
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscountVoucher $voucher)
    {
        $this->authorize('delete', $voucher);

        $voucher->delete();
        $voucher->deleteImage();

        return redirect()->route('discount_voucher.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\StoreDiscountVoucher;

use App\DiscountVoucher;

use App\Options\DiscountVoucherStatusOptions;

use App\Services\ImageService;

use Auth;

use Illuminate\Support\Facades\DB;

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
        $this->middleware('auth');
    }

    /**
     * Process uploaded image as needed and move to a correct location.
     * @param  \App\Services\ImageService              $imageService
     * @param  \App\Http\Requests\StoreDiscountVoucher $request
     * @param  string                                  $path
     * @return string                                  Image file name
     */
    private function processImage(&$imageService, &$request, $path)
    {
        $originalExtension = $request->file('image')->getClientOriginalExtension();
        $fileName = $imageService->generateUniqueFileName('discount_voucher_image_', $originalExtension);

        $imageService->process($request->file('image')->getRealPath(), $path, $fileName, 800);

        return $fileName;
    }

    /**
     * Sets new amount value or resets to NULL, default to NULL
     * @param \App\DiscountVoucher                    $voucher DiscountVoucher object
     * @param \App\Http\Requests\StoreDiscountVoucher $request Request
     * @return void
     */
    private function setAmount(&$voucher, &$request)
    {
        $amount = NULL;

        if ( $request->has('amount') )
        {
            $amount = ( (int) $request->amount >= 1 ) ? (int) $request->amount : NULL;
        }

        $voucher->amount = $amount;
    }

    /**
     * Display vouchers for a certain user.
     * @param  App\Options\DiscountVoucherStatusOptions $statusOptions Discount Voucher status options
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discount_vouchers/index')->with([
            'vouchers' => Auth::user()->discountVouchers,
        ]);
    }

    /**
     * Display a management listing of vouchers.
     * @param  App\Options\DiscountVoucherStatusOptions $statusOptions Discount Voucher status options
     * @return \Illuminate\Http\Response
     */
    public function manage(DiscountVoucherStatusOptions $statusOptions)
    {
        $this->authorize('create', DiscountVoucher::class);

        return view('discount_vouchers/manage')->with([
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
        $this->setAmount($voucher, $request);
        $voucher->status = (boolean) $request->status;

        $voucher->save();

        if ( $request->hasFile('image') )
        {
            $fileName = $this->processImage($imageService, $request, $voucher->getStoragePath());
            DB::table('discount_vouchers')
                ->where('id', $voucher->id)
                ->update(['image' => $fileName]);
        }

        return redirect()->route('discount_voucher.manage');
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
        $this->setAmount($voucher, $request);
        $voucher->status = (boolean) $request->status;

        if ( $request->hasFile('image') ) {
            $voucher->deleteImage();

            $voucher->image = $this->processImage($imageService, $request, $voucher->getStoragePath());
        }

        $voucher->save();

        return redirect()->route('discount_voucher.manage', [ '#' . $voucher->id ]);
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
        $voucher->deleteFileStorage();

        return redirect()->route('discount_voucher.manage');
    }
}

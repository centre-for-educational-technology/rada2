@if( config('services.userreport.key') )
<script type="text/javascript">
window._urq = window._urq || [];
_urq.push(['initSite', '<?php echo config('services.userreport.key'); ?>']);
(function() {
var ur = document.createElement('script'); ur.type = 'text/javascript'; ur.async = true;
ur.src = ('https:' == document.location.protocol ? 'https://cdn.userreport.com/userreport.js' : 'http://cdn.userreport.com/userreport.js');
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ur, s);
})();
</script>
@endif

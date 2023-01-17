<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/vendors.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/ui/prism.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/pickers/pickadate/pickadate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/forms/select/select2.min.css')}}">

<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-extended.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/colors.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/components.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/dark-layout.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/semi-dark-layout.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendors/css/extensions/jquery.rateyo.min.css')}}">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/core/menu/menu-types/vertical-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/app-user.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/faq.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/dashboard-analytics.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/users.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/plugins/extensions/ext-component-ratings.css')}}">
@if (Auth::user()->role == 'Pencari')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/core/menu/menu-types/horizontal-menu.css')}}">
@endif
<!-- END: Page CSS-->

{{-- BEGIN: EDITOR --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
{{-- END: EDITOR --}}
<!-- BEGIN: Custom CSS-->
{{-- <link rel="stylesheet" type="text/css" href="assets/css/style.css"> --}}
<!-- END: Custom CSS-->
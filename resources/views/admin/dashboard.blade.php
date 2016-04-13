@extends('dashboard')

@section('head')
    <!-- daterange picker -->
    <link href="{{ asset("/bower_components/admin-lte/plugins/daterangepicker/daterangepicker-bs3.css") }}" rel="stylesheet" type="text/css" />

    <!-- Ladda Themeless -->
    <link href="{{ asset("/css/ladda-themeless.min.css") }}" rel="stylesheet">

    <style>
        #reportRange{
            background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc
        }
    </style>
@endsection

@section('content')
@endsection

@section('footer')
    <!-- date-range-picker -->

@stop
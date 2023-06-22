@extends('layout')

@section('body')
  @php
  $user = \App\Models\User::findOrFail($id);
  @endphp


  @if (session('message'))
  <script>
    Swal.fire(
      'Informasi',
      '{{session('message')}}',
      'success'
    )
  </script>
  @endif

  @if ($errors->any() || session('error'))
    @php
      $errorMsg = '';
      $errorBag = collect($errors->getMessages())->values()->first();
      if ($errorBag) {
        $errorMsg = $errorBag[0];
      } else {
        $errorMsg = session('error');
      }
    @endphp
    <script>
      Swal.fire(
        'Informasi',
        '{{$errorMsg}}',
        'error'
      )
    </script>
  @endif
  <style>
    table { border-collapse:collapse; page-break-after:always }
      .gridlines td { border:1px dotted black }
      .gridlines th { border:1px dotted black }
      .b { text-align:center }
      .e { text-align:center }
      .f { text-align:right }
      .inlineStr { text-align:left }
      .n { text-align:right }
      .s { text-align:left }
      td.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10.0pt; background-color:white }
      th.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10.0pt; background-color:white }
      td.style1 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:14.0pt; background-color:#FFFFFF }
      th.style1 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:14.0pt; background-color:#FFFFFF }
      td.style2 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
      th.style2 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
      td.style3 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style3 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style4 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style4 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style5 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style5 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style6 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style6 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style7 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style7 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style8 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style8 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style9 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style9 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style10 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
      th.style10 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
      td.style11 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style11 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style12 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style12 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style13 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style13 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style14 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style14 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style15 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style15 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style16 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style16 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style17 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style17 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style18 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style18 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style19 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style19 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style20 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style20 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style21 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style21 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style22 { vertical-align:middle; text-align:center; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style22 { vertical-align:middle; text-align:center; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style23 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style23 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style24 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style24 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style25 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style25 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style26 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
      th.style26 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
      td.style27 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:7.0pt; background-color:#FFFFFF }
      th.style27 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:7.0pt; background-color:#FFFFFF }
      td.style28 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style28 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style29 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style29 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style30 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style30 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style31 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style31 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style32 { vertical-align:top; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style32 { vertical-align:top; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style33 { vertical-align:top; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style33 { vertical-align:top; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style34 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style34 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      table.sheet0 col.col0 { width:20.3333331pt }
      table.sheet0 col.col1 { width:111.83333205pt }
      table.sheet0 col.col2 { width:80.65555463pt }
      table.sheet0 col.col3 { width:42pt }
      table.sheet0 col.col4 { width:72.52222139pt }
      table.sheet0 col.col5 { width:42pt }
      table.sheet0 col.col6 { width:80.65555463pt }
      table.sheet0 col.col7 { width:42pt }
      table.sheet0 col.col8 { width:78.62222132pt }
      table.sheet0 col.col9 { width:42pt }
      table.sheet0 col.col10 { width:80.65555463pt }
      table.sheet0 col.col11 { width:42pt }
      table.sheet0 col.col12 { width:76.58888801pt }
      table.sheet0 col.col13 { width:42pt }
      table.sheet0 col.col14 { width:42pt }
      table.sheet0 col.col15 { width:84.04444348pt }
      table.sheet0 col.col16 { width:42pt }
      table.sheet0 col.col17 { width:109.12222097pt }
      table.sheet0 col.col18 { width:42pt }
      table.sheet0 col.col19 { width:69.13333254pt }
      table.sheet0 col.col20 { width:42pt }
      table.sheet0 col.col21 { width:42pt }
      table.sheet0 col.col22 { width:42pt }
      table.sheet0 col.col23 { width:42pt }
      table.sheet0 col.col24 { width:42pt }
      table.sheet0 col.col25 { width:42pt }
      table.sheet0 tr { height:15.75pt }
      table.sheet0 tr.row0 { height:30.75pt }
      table.sheet0 tr.row1 { height:30pt }
  </style>
  <!-- Main content -->
  <div class="container-fluid py-3">
    <div class="table-responsive">
      <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines" style="">
        <col class="col0">
        <col class="col1">
        <col class="col2">
        <col class="col3">
        <col class="col4">
        <col class="col5">
        <col class="col6">
        <col class="col7">
        <col class="col8">
        <col class="col9">
        <col class="col10">
        <col class="col11">
        <col class="col12">
        <col class="col13">
        <col class="col14">
        <col class="col15">
        <col class="col16">
        <col class="col17">
        <col class="col18">
        <col class="col19">
        <col class="col20">
        <col class="col21">
        <col class="col22">
        <col class="col23">
        <col class="col24">
        <col class="col25">
        <tbody>
          <tr class="row0">
            <td class="column0 style1 s style0" colspan="20">LAPORAN PENILAIAN HASIL PESERTA DIDIK SMP</td>
          </tr>
          <tr class="row1">
            <td class="column0 style3 s style0" colspan="20">1. INTRAKURIKULAR</td>
          </tr>
          <tr class="row2">
            <td class="column0 style4 s style0" colspan="6">NAMA PESERTA DIDIK : {{$user->getInformation('personalInformation','name')}}</td>
            <td class="column4 style3 null"></td>
            <td class="column5 style3 null"></td>
            <td class="column6 style3 null"></td>
            <td class="column7 style3 null"></td>
            <td class="column8 style3 null"></td>
            <td class="column9 style3 null"></td>
            <td class="column10 style3 null"></td>
            <td class="column11 style3 null"></td>
            <td class="column12 style3 null"></td>
            <td class="column13 style3 null"></td>
            <td class="column14 style3 null"></td>
            <td class="column15 style3 null"></td>
            <td class="column16 style3 null"></td>
            <td class="column17 style3 null"></td>
            <td class="column18 style3 null"></td>
            <td class="column19 style3 null"></td>

          </tr>
          <tr class="row3">
            <td class="column0 style4 s style0" colspan="4">NOMOR INDUK PESERTA DIDIK :</td>
            <td class="column4 style3 null"></td>
            <td class="column5 style3 null"></td>
            <td class="column6 style3 null"></td>
            <td class="column7 style3 null"></td>
            <td class="column8 style3 null"></td>
            <td class="column9 style3 null"></td>
            <td class="column10 style3 null"></td>
            <td class="column11 style3 null"></td>
            <td class="column12 style3 null"></td>
            <td class="column13 style3 null"></td>
            <td class="column14 style3 null"></td>
            <td class="column15 style5 s style0" colspan="10"><div>NOMOR INDUK SISWA NASIONAL : {{$user->getInformation('personalInformation','nisn')}}</div></td>
          </tr>
          <tr class="row4">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style3 null"></td>
            <td class="column5 style3 null"></td>
            <td class="column6 style3 null"></td>
            <td class="column7 style3 null"></td>
            <td class="column8 style3 null"></td>
            <td class="column9 style3 null"></td>
            <td class="column10 style3 null"></td>
            <td class="column11 style3 null"></td>
            <td class="column12 style3 null"></td>
            <td class="column13 style3 null"></td>
            <td class="column14 style3 null"></td>
            <td class="column15 style3 null"></td>
            <td class="column16 style3 null"></td>
            <td class="column17 style3 null"></td>
            <td class="column18 style3 null"></td>
            <td class="column19 style3 null"></td>

          </tr>
          <tr class="row5">
            @php
            $inYear = \Carbon\Carbon::parse(request('start_year') ?? $user->getInformation('educationInformation','transfer_date').'-01-01');
            @endphp
            <td class="column0 style6 s style7" colspan="2">TAHUN PELAJARAN</td>
            <td class="column2 style8 s style7" colspan="4">{{$inYear->year}}/{{$inYear->addYears(1)->year}}</td>
            <td class="column6 style8 s style7" colspan="4">{{$inYear->year}}/{{$inYear->addYears(1)->year}}</td>
            <td class="column10 style8 s style7" colspan="4">{{$inYear->year}}/{{$inYear->addYears(1)->year}}</td>
            <td class="column14 style8 s style7" colspan="6">IJAZAH TAHUN : {{$inYear->year}}</td>
          </tr>
          <tr class="row6">
            <td class="column0 style6 s style7" colspan="2">KELAS</td>
            <td class="column2 style8 n style7" colspan="4">7</td>
            <td class="column6 style8 n style7" colspan="4">8</td>
            <td class="column10 style8 n style7" colspan="4">9</td>
            <td class="column14 style8 s style7" colspan="6">NILAI LAMPIRAN IJAZAH</td>
          </tr>
          <tr class="row7">
            <td class="column0 style6 s style7" colspan="2">SEMESTER</td>
            <td class="column2 style8 n style7" colspan="2">Ganjil</td>
            <td class="column4 style8 n style7" colspan="2">Genap</td>
            <td class="column2 style8 n style7" colspan="2">Ganjil</td>
            <td class="column4 style8 n style7" colspan="2">Genap</td>
            <td class="column2 style8 n style7" colspan="2">Ganjil</td>
            <td class="column4 style8 n style7" colspan="2">Genap</td>
            <td class="column14 style11 s">NR</td>
            <td class="column15 style12 s style19" rowspan="3">CAPAIAN KOMPETENS</td>
            <td class="column16 style11 s">NS</td>
            <td class="column17 style13 s style19" rowspan="3">CAPAIAN KOMPETENSI</td>
            <td class="column18 style11 s">NS</td>
            <td class="column19 style12 s style19" rowspan="3">CAPAIAN KOMPETENSI</td>
          </tr>
          <tr class="row8">
            <td class="column0 style14 s style18" colspan="2" rowspan="2">MATA PELAJARAN</td>
            <td class="column2 style12 s style19" rowspan="2">CAPAIAN KOMPETENSI</td>
            <td class="column3 style13 s style19" rowspan="2">NA</td>
            <td class="column4 style12 s style19" rowspan="2">CAPAIAN KOMPETENSI</td>
            <td class="column5 style13 s style19" rowspan="2">NA</td>
            <td class="column6 style12 s style19" rowspan="2">CAPAIAN KOMPETENSI</td>
            <td class="column7 style13 s style19" rowspan="2">NA</td>
            <td class="column8 style12 s style19" rowspan="2">CAPAIAN KOMPETENS</td>
            <td class="column9 style13 s style19" rowspan="2">NA</td>
            <td class="column10 style12 s style19" rowspan="2">CAPAIAN KOMPETENSI</td>
            <td class="column11 style13 s style19" rowspan="2">NA</td>
            <td class="column12 style12 s style19" rowspan="2">CAPAIAN KOMPETENS</td>
            <td class="column13 style13 s style19" rowspan="2">NA</td>
            <td class="column14 style13 s style19" rowspan="2">ANGKA</td>
            <td class="column16 style13 s style19" rowspan="2">ANGKA</td>
            <td class="column18 style13 s style19" rowspan="2">ANGKA</td>
          </tr>
          <tr class="row9">
          </tr>
          @php
          $mapels = \App\Models\Mapel::all();
          $k = 0;
          @endphp
          @foreach ($mapels as $k => $item)
          @php
          $inYear = \Carbon\Carbon::parse(request('start_year') ?? $user->getInformation('educationInformation','transfer_date').'-01-01');
          // dd($user->studentEvaluations()->where('mapels.id',$item->id)->get()->toArray());
          @endphp
          <tr class="row10">
            <td class="column0 style20 n">{{$k}}</td>
            <td class="column1 style21 s">{{$item->name}}</td>
            <td class="column2 style22 null">{{$user->studentEvaluations()->where('mapels.id',$item->id)->wherePivot('semester', 'Ganjil')->wherePivot('school_year',$inYear->year.'/'.$inYear->addYears(1)->year)->first()->pivot->number ?? ''}}</td>
            <td class="column3 style22 null"></td>
            <td class="column4 style22 null">{{$user->studentEvaluations()->where('mapels.id',$item->id)->wherePivot('semester', 'Genap')->wherePivot('school_year',$inYear->year.'/'.$inYear->addYears(1)->year)->first()->pivot->number ?? ''}}</td>
            <td class="column5 style22 null"></td>
            <td class="column6 style22 null">{{$user->studentEvaluations()->where('mapels.id',$item->id)->wherePivot('semester', 'Ganjil')->wherePivot('school_year',$inYear->year.'/'.$inYear->addYears(1)->year)->first()->pivot->number ?? ''}}</td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null">{{$user->studentEvaluations()->where('mapels.id',$item->id)->wherePivot('semester', 'Genap')->wherePivot('school_year',$inYear->year.'/'.$inYear->addYears(1)->year)->first()->pivot->number ?? ''}}</td>
            <td class="column9 style22 null"></td>
            <td class="column10 style22 null">{{$user->studentEvaluations()->where('mapels.id',$item->id)->wherePivot('semester', 'Ganjil')->wherePivot('school_year',$inYear->year.'/'.$inYear->addYears(1)->year)->first()->pivot->number ?? ''}}</td>
            <td class="column11 style22 null"></td>
            <td class="column12 style22 null">{{$user->studentEvaluations()->where('mapels.id',$item->id)->wherePivot('semester', 'Genap')->wherePivot('school_year',$inYear->year.'/'.$inYear->addYears(1)->year)->first()->pivot->number ?? ''}}</td>
            <td class="column13 style22 null"></td>
            <td class="column14 style22 null"></td>
            <td class="column15 style22 null"></td>
            <td class="column16 style22 null"></td>
            <td class="column17 style22 null"></td>
            <td class="column18 style22 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          @endforeach
          {{-- @foreach ([,$inYear->year.'/'.$inYear->addYears(1)->year,$inYear->year.'/'.$inYear->addYears(1)->year] as $item)

          @endforeach --}}

          <tr class="row19">
            <td class="column0 style20 n">{{$k}}</td>
            <td class="column1 style21 s">Seni dan Prakarya</td>
            <td class="column2 style22 null"></td>
            <td class="column3 style22 null"></td>
            <td class="column4 style22 null"></td>
            <td class="column5 style22 null"></td>
            <td class="column6 style22 null"></td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null"></td>
            <td class="column9 style22 null"></td>
            <td class="column10 style22 null"></td>
            <td class="column11 style22 null"></td>
            <td class="column12 style22 null"></td>
            <td class="column13 style22 null"></td>
            <td class="column14 style22 null"></td>
            <td class="column15 style22 null"></td>
            <td class="column16 style22 null"></td>
            <td class="column17 style22 null"></td>
            <td class="column18 style22 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          <tr class="row20">
            <td class="column0 style23 null"></td>
            <td class="column1 style21 s">1. Seni Musik</td>
            <td class="column2 style22 null"></td>
            <td class="column3 style22 null"></td>
            <td class="column4 style22 null"></td>
            <td class="column5 style22 null"></td>
            <td class="column6 style22 null"></td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null"></td>
            <td class="column9 style22 null"></td>
            <td class="column10 style22 null"></td>
            <td class="column11 style22 null"></td>
            <td class="column12 style22 null"></td>
            <td class="column13 style22 null"></td>
            <td class="column14 style22 null"></td>
            <td class="column15 style22 null"></td>
            <td class="column16 style22 null"></td>
            <td class="column17 style22 null"></td>
            <td class="column18 style22 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          <tr class="row21">
            <td class="column0 style23 null"></td>
            <td class="column1 style21 s">2. Seni Rupa</td>
            <td class="column2 style22 null"></td>
            <td class="column3 style22 null"></td>
            <td class="column4 style22 null"></td>
            <td class="column5 style22 null"></td>
            <td class="column6 style22 null"></td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null"></td>
            <td class="column9 style22 null"></td>
            <td class="column10 style22 null"></td>
            <td class="column11 style22 null"></td>
            <td class="column12 style22 null"></td>
            <td class="column13 style22 null"></td>
            <td class="column14 style22 null"></td>
            <td class="column15 style22 null"></td>
            <td class="column16 style22 null"></td>
            <td class="column17 style22 null"></td>
            <td class="column18 style22 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          <tr class="row22">
            <td class="column0 style23 null"></td>
            <td class="column1 style21 s">3. Seni Teater</td>
            <td class="column2 style22 null"></td>
            <td class="column3 style22 null"></td>
            <td class="column4 style22 null"></td>
            <td class="column5 style22 null"></td>
            <td class="column6 style22 null"></td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null"></td>
            <td class="column9 style22 null"></td>
            <td class="column10 style22 null"></td>
            <td class="column11 style22 null"></td>
            <td class="column12 style22 null"></td>
            <td class="column13 style22 null"></td>
            <td class="column14 style22 null"></td>
            <td class="column15 style22 null"></td>
            <td class="column16 style22 null"></td>
            <td class="column17 style22 null"></td>
            <td class="column18 style22 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          <tr class="row23">
            <td class="column0 style23 null"></td>
            <td class="column1 style21 s">4. Seni Tari</td>
            <td class="column2 style22 null"></td>
            <td class="column3 style22 null"></td>
            <td class="column4 style22 null"></td>
            <td class="column5 style22 null"></td>
            <td class="column6 style22 null"></td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null"></td>
            <td class="column9 style22 null"></td>
            <td class="column10 style22 null"></td>
            <td class="column11 style22 null"></td>
            <td class="column12 style22 null"></td>
            <td class="column13 style22 null"></td>
            <td class="column14 style22 null"></td>
            <td class="column15 style22 null"></td>
            <td class="column16 style22 null"></td>
            <td class="column17 style22 null"></td>
            <td class="column18 style22 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          <tr class="row24">
            <td class="column0 style23 null"></td>
            <td class="column1 style21 s">5. Prakarya (Budidaya Kerajinan Rekayasa atau Pengolahan)</td>
            <td class="column2 style22 null"></td>
            <td class="column3 style22 null"></td>
            <td class="column4 style22 null"></td>
            <td class="column5 style22 null"></td>
            <td class="column6 style22 null"></td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null"></td>
            <td class="column9 style22 null"></td>
            <td class="column10 style22 null"></td>
            <td class="column11 style22 null"></td>
            <td class="column12 style22 null"></td>
            <td class="column13 style22 null"></td>
            <td class="column14 style22 null"></td>
            <td class="column15 style22 null"></td>
            <td class="column16 style22 null"></td>
            <td class="column17 style22 null"></td>
            <td class="column18 style22 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          <tr class="row25">
            <td class="column0 style20 n">11</td>
            <td class="column1 style22 null"></td>
            <td class="column2 style22 null"></td>
            <td class="column3 style22 null"></td>
            <td class="column4 style22 null"></td>
            <td class="column5 style22 null"></td>
            <td class="column6 style22 null"></td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null"></td>
            <td class="column9 style22 null"></td>
            <td class="column10 style22 null"></td>
            <td class="column11 style22 null"></td>
            <td class="column12 style22 null"></td>
            <td class="column13 style22 null"></td>
            <td class="column14 style22 null"></td>
            <td class="column15 style22 null"></td>
            <td class="column16 style22 null"></td>
            <td class="column17 style22 null"></td>
            <td class="column18 style22 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          <tr class="row26">
            <td class="column0 style8 s style7" colspan="2">JUMLAH</td>
            <td class="column2 style22 null"></td>
            <td class="column3 style22 null"></td>
            <td class="column4 style22 null"></td>
            <td class="column5 style22 null"></td>
            <td class="column6 style22 null"></td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null"></td>
            <td class="column9 style22 null"></td>
            <td class="column10 style22 null"></td>
            <td class="column11 style22 null"></td>
            <td class="column12 style22 null"></td>
            <td class="column13 style22 null"></td>
            <td class="column14 style22 null"></td>
            <td class="column15 style22 null"></td>
            <td class="column16 style22 null"></td>
            <td class="column17 style22 null"></td>
            <td class="column18 style22 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          <tr class="row27">
            <td class="column0 style8 s style7" colspan="2">RATA-RATA</td>
            <td class="column2 style22 null"></td>
            <td class="column3 style22 null"></td>
            <td class="column4 style22 null"></td>
            <td class="column5 style22 null"></td>
            <td class="column6 style22 null"></td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null"></td>
            <td class="column9 style22 null"></td>
            <td class="column10 style22 null"></td>
            <td class="column11 style22 null"></td>
            <td class="column12 style22 null"></td>
            <td class="column13 style22 null"></td>
            <td class="column14 style24 s style18" colspan="4" rowspan="4">RATA-RATA</td>
            <td class="column18 style26 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          <tr class="row28">
            <td class="column0 style27 s style19" rowspan="3">International</td>
            <td class="column1 style28 n">1</td>
            <td class="column2 style22 null"></td>
            <td class="column3 style22 null"></td>
            <td class="column4 style22 null"></td>
            <td class="column5 style22 null"></td>
            <td class="column6 style22 null"></td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null"></td>
            <td class="column9 style22 null"></td>
            <td class="column10 style22 null"></td>
            <td class="column11 style22 null"></td>
            <td class="column12 style22 null"></td>
            <td class="column13 style22 null"></td>
            <td class="column18 style26 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          <tr class="row29">
            <td class="column1 style28 n">2</td>
            <td class="column2 style22 null"></td>
            <td class="column3 style22 null"></td>
            <td class="column4 style22 null"></td>
            <td class="column5 style22 null"></td>
            <td class="column6 style22 null"></td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null"></td>
            <td class="column9 style22 null"></td>
            <td class="column10 style22 null"></td>
            <td class="column11 style22 null"></td>
            <td class="column12 style22 null"></td>
            <td class="column13 style22 null"></td>
            <td class="column18 style26 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          <tr class="row30">
            <td class="column1 style28 n">3</td>
            <td class="column2 style22 null"></td>
            <td class="column3 style22 null"></td>
            <td class="column4 style22 null"></td>
            <td class="column5 style22 null"></td>
            <td class="column6 style22 null"></td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null"></td>
            <td class="column9 style22 null"></td>
            <td class="column10 style22 null"></td>
            <td class="column11 style22 null"></td>
            <td class="column12 style22 null"></td>
            <td class="column13 style22 null"></td>
            <td class="column18 style26 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          <tr class="row31">
            <td class="column0 style27 s style19" rowspan="3">Ekstrakulikular</td>
            @php
            $inYear = \Carbon\Carbon::parse(request('start_year') ?? $user->getInformation('educationInformation','transfer_date').'-01-01');
            $yA = [$inYear.'/'.$inYear->addYears(1)->year,$inYear.'/'.$inYear->addYears(1)->year,$inYear.'/'.$inYear->addYears(1)->year];
            @endphp
            <td class="column1 style28 s">Sakit</td>
            @foreach ($yA as $item)
            <td class="column2 style32 s style7" colspan="2">{{$user->unpresent()->whereSemester('Ganjil')->whereSchool_year($item)->first()->sick ?? 0}} Hari</td>
            <td class="column2 style32 s style7" colspan="2">{{$user->unpresent()->whereSemester('Genap')->whereSchool_year($item)->first()->sick ?? 0}} Hari</td>
            @endforeach
            <td class="column14 style22 null"></td>
            <td class="column15 style22 null"></td>
            <td class="column16 style22 null"></td>
            <td class="column17 style22 null"></td>
            <td class="column18 style26 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          <tr class="row32">
            @php
            $inYear = \Carbon\Carbon::parse(request('start_year') ?? $user->getInformation('educationInformation','transfer_date').'-01-01');
            $yA = [$inYear.'/'.$inYear->addYears(1)->year,$inYear.'/'.$inYear->addYears(1)->year,$inYear.'/'.$inYear->addYears(1)->year];
            @endphp
            <td class="column1 style28 s">Izin</td>
            @foreach ($yA as $item)
            <td class="column2 style32 s style7" colspan="2">{{$user->unpresent()->whereSemester('Ganjil')->whereSchool_year($item)->first()->permission ?? 0}} Hari</td>
            <td class="column2 style32 s style7" colspan="2">{{$user->unpresent()->whereSemester('Genap')->whereSchool_year($item)->first()->permission ?? 0}} Hari</td>
            @endforeach
            <td class="column14 style22 null"></td>
            <td class="column15 style22 null"></td>
            <td class="column16 style22 null"></td>
            <td class="column17 style22 null"></td>
            <td class="column18 style26 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          <tr class="row33">
            <td class="column1 style28 s">Tanpa Keterangan</td>
            @php
            $inYear = \Carbon\Carbon::parse(request('start_year') ?? $user->getInformation('educationInformation','transfer_date').'-01-01');
            $yA = [$inYear.'/'.$inYear->addYears(1)->year,$inYear.'/'.$inYear->addYears(1)->year,$inYear.'/'.$inYear->addYears(1)->year];
            @endphp
            @foreach ($yA as $item)
            <td class="column2 style32 s style7" colspan="2">{{$user->unpresent()->whereSemester('Ganjil')->whereSchool_year($item)->first()->alpha ?? 0}} Hari</td>
            <td class="column2 style32 s style7" colspan="2">{{$user->unpresent()->whereSemester('Genap')->whereSchool_year($item)->first()->alpha ?? 0}} Hari</td>
            @endforeach
            <td class="column14 style22 null"></td>
            <td class="column15 style22 null"></td>
            <td class="column16 style22 null"></td>
            <td class="column17 style22 null"></td>
            <td class="column18 style26 null"></td>
            <td class="column19 style22 null"></td>
          </tr>
          <tr class="row34">
            <td class="column0 style33 s style7" colspan="2">Status Akhir Tahun</td>
            <td class="column2 style34 s style7" colspan="2">Naik ke/ Tinggal ke  Kelas</td>
            <td class="column4 style34 s style7" colspan="2">Naik ke/ Tinggal ke  Kelas</td>
            <td class="column6 style34 s style7" colspan="2">Naik ke/ Tinggal ke  Kelas</td>
            <td class="column8 style34 s style7" colspan="2">Naik ke/ Tinggal ke  Kelas</td>
            <td class="column10 style34 s style7" colspan="2">Naik ke/ Tinggal ke  Kelas</td>
            <td class="column12 style34 s style7" colspan="2">Naik ke/ Tinggal ke  Kelas</td>
            <td class="column14 style33 s style7" colspan="4">LULUS / TIDAK LULUS</td>
            <td class="column18 style26 null"></td>
            <td class="column19 style22 null"></td>
          </tr>

        </tbody>
    </table>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('.btn-submit').click(function() {
        const url = $(this).data('url')
        Swal.fire({
          title: 'Setelah submit raport akan di kirim ke admin',
          text: "",
          type: "success",
          showDenyButton: true,
          showCancelButton: false,
          confirmButtonText: 'Ya, Submit',
          denyButtonText: `Tidak`,
        }).then((result) => {
          if (result.isConfirmed) {
            document.location.href = url;
          }
        })
      })
    })
  </script>
@endsection

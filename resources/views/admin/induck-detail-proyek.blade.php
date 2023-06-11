@extends('layout')

@section('body')
  @php
  $user = \App\Models\User::findOrFail($id);
  $inYear = \Carbon\Carbon::parse($user->getInformation('educationInformation','transfer_date').'-01-01');
  $startYear = $inYear->year;
  $secondYear = $inYear->addYears(1)->year;
  $thirdYear = $inYear->addYears(1)->year;
  $schoolYears = [
    $startYear,$secondYear,$thirdYear
  ];
  $projects = \App\Models\Project::all();
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
    table { border-collapse:collapse; page-break-after:always; }
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
      td.style1 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style1 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style2 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style2 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style3 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style3 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style4 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style4 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style5 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:9.0pt; background-color:#FFFFFF }
      th.style5 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:9.0pt; background-color:#FFFFFF }
      td.style6 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style6 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style7 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style7 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style8 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style8 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style9 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style9 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style10 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style10 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style11 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:10.0pt; background-color:#FFFFFF }
      th.style11 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:10.0pt; background-color:#FFFFFF }
      td.style12 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:14.0pt; background-color:#FFFFFF }
      th.style12 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:14.0pt; background-color:#FFFFFF }
      td.style13 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
      th.style13 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
      td.style14 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style14 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style15 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style15 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style16 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style16 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style17 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style17 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style18 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
      th.style18 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
      td.style19 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style19 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style20 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style20 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style21 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style21 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style22 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style22 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style23 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style23 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style24 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style24 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style25 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style25 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style26 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style26 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style27 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style27 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style28 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style28 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style29 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style29 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style30 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
      th.style30 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
      td.style31 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:7.0pt; background-color:#FFFFFF }
      th.style31 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#212529; font-family:'Chivo'; font-size:7.0pt; background-color:#FFFFFF }
      td.style32 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style32 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style33 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style33 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style34 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style34 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style35 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style35 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style36 { vertical-align:top; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style36 { vertical-align:top; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style37 { vertical-align:top; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style37 { vertical-align:top; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      td.style38 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      th.style38 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#212529; font-family:'Chivo'; font-size:12.0pt; background-color:#FFFFFF }
      table.sheet0 col.col0 { width:147.07777609pt }
      table.sheet0 col.col1 { width:27.1111108pt }
      table.sheet0 col.col2 { width:31.85555519pt }
      table.sheet0 col.col3 { width:30.49999965pt }
      table.sheet0 col.col4 { width:23.04444418pt }
      table.sheet0 col.col5 { width:22.36666641pt }
      table.sheet0 col.col6 { width:23.04444418pt }
      table.sheet0 col.col7 { width:27.78888857pt }
      table.sheet0 col.col8 { width:23.72222195pt }
      table.sheet0 col.col9 { width:21.68888864pt }
      table.sheet0 col.col10 { width:21.01111087pt }
      table.sheet0 col.col11 { width:27.1111108pt }
      table.sheet0 col.col12 { width:25.07777749pt }
      table.sheet0 tr { height:15.75pt }
  </style>
  <!-- Main content -->
  <div class="container-fluid py-3">
    <div class="d-flex justify-content-center font-weight-bold mb-3">
      LAPORAN PENILAIAN HASIL PESERTA DIDIK SMP
    </div>
    <div class="d-flex justify-content-between mb-1">
      <div>LAPORAN PENILAIAN HASIL PESERTA DIDIK SMP : </div>
    </div>
    <div class="d-flex justify-content-between mb-2">
      <div>NOMOR INDUK PESERTA DIDIK :</div>
      <div>NOMOR INDUK SISWA NASIONAL :</div>
    </div>
    <div class="table-responsive mx-auto">
      @foreach ([1,2] as $rowSemester)
      <table border="0" cellpadding="0" cellspacing="0" id="sheet0" style="width: 100%;" class="sheet0 gridlines mx-auto mb-3">
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
        <tbody>
          <tr class="row0">
            <td class="column0 style1 s">TAHUN PELAJARAN</td>
            @foreach ($schoolYears as $item)
            <td class="column1 style2 s style4" colspan="4">{{$item}}/{{$item+1}}</td>
            @endforeach
          </tr>
          <tr class="row1">
            <td class="column0 style1 s">KELAS</td>
            <td class="column1 style2 n style4" colspan="4">7</td>
            <td class="column5 style2 n style4" colspan="4">8</td>
            <td class="column9 style2 n style4" colspan="4">9</td>
          </tr>
          <tr class="row2">
            <td class="column0 style1 s">SEMESTER</td>
            <td class="column1 style2 n style4" colspan="12">{{$rowSemester}}</td>
          </tr>
          <tr class="row3">
            <td class="column0 style5 s style5">TEMA / ELEMENT / SUPLEMEN</td>
            <td class="column1 style6 s style6">BB</td>
            <td class="column2 style7 s style7">MB</td>
            <td class="column3 style6 s style6">BSH</td>
            <td class="column4 style7 s style7">SB</td>
            <td class="column5 style6 s style6">BB</td>
            <td class="column6 style7 s style7">MB</td>
            <td class="column7 style6 s style6">BSH</td>
            <td class="column8 style7 s style7">SB</td>
            <td class="column9 style6 s style6">BB</td>
            <td class="column10 style7 s style7">MB</td>
            <td class="column11 style6 s style6">BSH</td>
            <td class="column12 style7 s style7">SB</td>
          </tr>
          <tr class="row5">
            <td class="column0 style9 s">PROYEK 1 / TEMA 1</td>
            <td class="column1 style10 null"></td>
            <td class="column2 style10 null"></td>
            <td class="column3 style10 null"></td>
            <td class="column4 style10 null"></td>
            <td class="column5 style10 null"></td>
            <td class="column6 style10 null"></td>
            <td class="column7 style10 null"></td>
            <td class="column8 style10 null"></td>
            <td class="column9 style10 null"></td>
            <td class="column10 style10 null"></td>
            <td class="column11 style10 null"></td>
            <td class="column12 style10 null"></td>
          </tr>
          <tr class="row6">
            <td class="column0 style9 s">DIMENSI</td>
            <td class="column1 style10 null"></td>
            <td class="column2 style10 null"></td>
            <td class="column3 style10 null"></td>
            <td class="column4 style10 null"></td>
            <td class="column5 style10 null"></td>
            <td class="column6 style10 null"></td>
            <td class="column7 style10 null"></td>
            <td class="column8 style10 null"></td>
            <td class="column9 style10 null"></td>
            <td class="column10 style10 null"></td>
            <td class="column11 style10 null"></td>
            <td class="column12 style10 null"></td>
          </tr>
          @foreach ($projects as $k => $row)
          <tr class="row7">
            <td class="column0 style11 s">{{$k+1}}. {{$row->name}}</td>
            @foreach ($schoolYears as $rowYear)
              @foreach (['bb','mb','bsh','sb'] as $rowEvaluation)
              @php
              $projectEvaluation = \App\Models\EvaluationProject::whereUser_id($user->id)->whereSemester($rowSemester)
              ->whereSchool_year($rowYear.'/'.$rowYear+1)
              ->where('project_id', $row->id)->first();
              @endphp
              <td class="column1 style10 null"><input type="text" value="{{$projectEvaluation->{$rowEvaluation} ?? ''}}" name="" id="" class="form-control-plaintext text-center input p-0" data-user-id="{{$user->id}}" data-name="{{$rowEvaluation}}" data-school-year="{{$rowYear}}" data-semester="{{$rowSemester}}" data-project-id="{{$row->id}}" /></td>
              @endforeach
            @endforeach
          </tr>
          @endforeach
        </tbody>
      </table>
      @endforeach
      <table class="table-borderless" style="width: 300px;">
        <tbody>
          <tr>
            <td colspan="2">KETERANGAN :</td>
          </tr>
          @foreach ([
            ['BB', 'Belum Berkembang'],
            ['MB', 'Mulai Berkembang'],
            ['BSH', 'Berkembang Sesuai Harapan'],
            ['Sb', 'Sangat Berkembang'],
          ] as $item)
          <tr>
            <td>{{$item[0]}}</td>
            <td>: {{$item[1]}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script>
    var pending = [null]
    var currentProjectId = null
    $(document).ready(function() {
      $('.input').keyup(function(e) {
        const currentInput = $(this)
        const payload = {
          projectId: $(e.target).data('project-id'),
          semester: $(e.target).data('semester'),
          schoolYear: $(e.target).data('school-year'),
          userId: $(e.target).data('user-id'),
          name: $(e.target).data('name'),
          value: $(e.target).val(),
        }
        $.post('{{url('admin/induck/store_project')}}', payload, function(data) {})
        currentProjectId = currentInput.data('project-id')
      })
    })
  </script>
@endsection

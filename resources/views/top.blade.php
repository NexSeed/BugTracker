@extends('layout')

@section('title', "TOP")

@section('content')


    <div class="btn-controls">
        <div class="btn-box-row row-fluid">
            <a href={{url("articleslist/Status/UnDone/System/ERP")}} class="btn-box big span4 top-erp"><i class=" icon-book"></i><b class="top_btn">ERP<label class="top-count">{{ $doneERP }}</label></b>

                <p class="text-muted">
                </p>
            </a><a href={{url("articleslist/Status/UnDone/System/HackersStory")}} class="btn-box big span4 top-hs"><i class="icon-user"></i><b class="top_btn">Hacker's Story<label class="top-count">{{ $doneHS }}</label></b>
                <p class="text-muted">
                    </p>
            </a><a href={{url("articleslist/Status/UnDone/System/BugnoTra")}} class="btn-box big span4 top-hs"><i class="icon-signal"></i><b class="top_btn">バグの虎<label class="top-count">{{ $doneBT }}</label></b>
                <p class="text-muted">
                    </p>
            </a>
        </div>
        <div class="btn-box-row row-fluid">
            <ul class="widget widget-usage unstyled span4 top-bar">
                <li>
                    <p>
                        @if ($allERP > 0)
                        {{-- */ $ERPper = (float)$doneERP/(float)$allERP*100 /* --}}
                        @else
                        {{-- */ $ERPper = 0 /* --}}
                        @endif
                        <strong>ERP</strong> <span class="pull-right  muted">{{ $ERPper }}%</span>
                    </p>
                    <div class="progress tight">
                        <div class="bar bar-success" style="width: {{ $ERPper }}%;">
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="widget widget-usage unstyled span4 top-bar">
                <li>
                    <p>
                        @if ($allHS > 0)
                        {{-- */ $HSper = (float)$doneHS/(float)$allHS*100 /* --}}
                        @else
                        {{-- */ $HSper = 0 /* --}}
                        @endif
                        <strong>Hacker's Story</strong> <span class="pull-right  muted">{{ $HSper }}%</span>
                    </p>
                    <div class="progress tight">
                        <div class="bar" style="width: {{ $HSper }}%;">
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="widget widget-usage unstyled span4 top-bar">
                <li>
                    <p>
                        @if ($allBT > 0)
                        {{-- */ $BTper = (float)$doneBT/(float)$allBT*100 /* --}}
                        @else
                        {{-- */ $BTper = 0 /* --}}
                        @endif
                        <strong>BugnoTra</strong> <span class="pull-right  muted">{{ $BTper }}%</span>
                    </p>
                    <div class="progress tight">
                        <div class="bar bar-danger" style="width: {{ $BTper }}%;">
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        @if (Auth::check())
        <hr>
        <div class="btn-box-row row-fluid">
            <a href={{url("articles/create")}} class="btn-box small span2">
                <i class="icon-edit"></i>
                  <b>New Report</b>
            </a>
        </div>
        @endif


    </div>

@endsection


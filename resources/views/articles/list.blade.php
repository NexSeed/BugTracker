@extends('layout')

@section('beforebody_js')
    @include('articles.tab_js')
@endsection <!--  beforebody_js -->

@section('content')

@include('articles.tabs')


    <div class="module">
        <div class="module-head">
            <div class="list_state">
                <li><a href={{url("articleslist/Status/1/System/". $system)}}>Not yet({{ $statusCounts[0] }})</a></li>
                <li><a href={{url("articleslist/Status/2/System/". $system)}}>Doing({{ $statusCounts[1] }})</a></li>
                <li><a href={{url("articleslist/Status/3/System/". $system)}}>Done({{ $statusCounts[2] }})</a></li>
                <li><a href={{url("articleslist/Status/4/System/". $system)}}>Pending({{ $statusCounts[3] }})</a></li>
            </div>
        </div>
        <div class="module-body table list-table">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-striped  display"
                width="100%">
                <thead>
                    <tr>
                        <th>
                            System
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Priority
                        </th>
                        <th>
                            Type
                        </th>
                        <th>
                            Author
                        </th>
                        <th>
                            Summary
                        </th>
                        <th>
                            Time
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                    <tr class="odd gradeX">
                        <td>
                            {{ $article->system }}
                        </td>
                        <td>
                            {{ $article->status() }}
                        </td>
                        <td>
                            {{ $article->urgency }}
                        </td>
                        <td class="cell-icon">
                            {{ $article->type }}
                        </td>
                        <td class="hidden-phone hidden-tablet">
                            {{ $article->user()->first()->name }}
                        </td>
                        <td class="cell-title">
                            <a href="{{ url('articles', $article->id) }}">{{ $article->title }}</a>
                        </td>
                        <td class="align-right">
                            {{ $article->created_at }}
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <!--/.module-->

@endsection <!--  content -->

@section('additionaljs')


@endsection <!--  additionaljs -->

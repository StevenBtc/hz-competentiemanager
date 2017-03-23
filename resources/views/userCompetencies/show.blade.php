
@extends('layouts.app')

@section('title')
  Your competencies
@endsection

@section('content')

    <h1>Dag {{ Auth::user()->name }} ({{ Auth::user()->id }}), hier zijn jouw competenties</h1>
    <h2>

        <table style="width:100%">
            <tr>
                <th>ID Competentie</th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="Language" value= <?= $userComps = DB::table('user_competencies')->pluck('competency_id');?>>
                </td>
            </tr>

            @foreach ($userComps as $userComp)
                <tr>
                    <td>
                        {{ $userComp }}
                    </td>
                </tr>
            @endforeach

        </table>
    </h2>

@endsection
@section('scripts')
    {{--<script>--}}
    {{--<?php--}}
    {{--if( $name == NULL) {--}}
    {{--header('Location: welcome.blade.php ');--}}
    {{--} else--}}



    {{--?>--}}

    {{--</script>--}}
    <script>
        jQuery(document).ready(function($) {
            $(".row-link").click(function() {
                window.document.project = $(this).data("href");
            });
            $('#cohort-tabs a:first').tab('show') // Select first tab
        });
    </script>
@endsection

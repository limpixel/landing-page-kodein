<?php 
    $components = DB::table("components")->orderBy("order")->get();
?>

@extends('layouts.frontend')

@section('js')
<script>
    $('.carousel').carousel()

</script>
@endsection

@section('content')
    @foreach ($components as $component)
        {!! $component->code !!}
    @endforeach
@endsection

@extends('layouts.app')

@section('content')
  @foreach($jobs as $job)
    <livewire:job :job="$job">
  @endforeach
@endsection

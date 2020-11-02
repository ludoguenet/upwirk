@extends('layouts.app')

@section('content')
  <h1 class="text-3xl text-green-500 mb-5">{{ $id->title }}</h1>
  <p class="text-base text-gray-700 mb-4">
  {{ $id->description }}
  </p>
  <a href="{{ route('proposals.submit', $id->id) }}" class="bg-green-500 text-white hover:bg-green-700 transition ease-in-out duration-500 rounded-md shadow-md px-4 py-2 mt-3">Soumettre une proposition</a>
@endsection
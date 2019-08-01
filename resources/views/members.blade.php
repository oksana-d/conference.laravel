@extends('layouts.app')

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="text-center">All members</h1>
        </div>
    </div>
    @isset($members)
    <div class="row">
        <div class="col">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Report subject</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $members as $member )
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>
                            <img class="img rounded-circle profile-img" src="{{ asset('users/' . $member->photo) }}" alt="user_photo">
                        </td>
                        <td>{{ $member->firstname }} {{ $member->lastname }}</td>
                        <td>{{ $member->reportSubject }}</td>
                        <td><a href="mailto:{{ $member->email }}">{{ $member->email }}</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endisset
    <div class="row">
        <div class="col">
            <a href="{{ url('/') }}" class="members btn btn-success float-right">Back to homepage</a>
        </div>
    </div>
</div>

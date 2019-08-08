@extends('layouts.app')

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="text-center">All members</h1>
        </div>
    </div>
    @if(isset($members) && empty(!$members))
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
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <th>Show</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $members as $member )
                            <tr>
                                <td scope="row">{{ $loop->iteration + ($members->currentPage() - 1) * 10 }}</td>
                                <td>
                                    <img class="img rounded-circle profile-img"
                                         src="{{ asset('users/' . $member->photo) }}" alt="user_photo">
                                </td>
                                <td>{{ $member->firstname }} {{ $member->lastname }}</td>
                                <td>{{ $member->reportSubject }}</td>
                                <td><a href="mailto:{{ $member->email }}">{{ $member->email }}</a></td>
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                   value="{{ $member->idUser }}" id="userCheckBox{{ $member->idUser }}"
                                                   @if($member->show) checked @endif/>
                                            <label class="custom-control-label" for="userCheckBox{{ $member->idUser }}">
                                                @if($member->show) Hide this member in the list of All members  @else
                                                    Show this member in the list of All members @endif</label>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if($members->total() > $members->count())
            <div class="row justify-content-center">
                {{ $members->links() }}
            </div>
        @endif
    @else
        <p class="text-center"> List of conference participants is empty</p>
    @endif
    @if(!\Illuminate\Support\Facades\Auth::check())
        <div class="row">
            <div class="col">
                <a href="{{ url('/') }}" class="members btn btn-success float-right">Back to homepage</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col">
                <a href="{{ url('/logout') }}" class="members btn btn-success float-right">Logout</a>
            </div>
        </div>
    @endif
</div>

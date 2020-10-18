@extends('layouts.centered_content')

@section('title', 'View Users')

@section('centered_content')

@table
    @slot('title', 'All Users')

    @slot('search_form')
        {{--  Search form  --}}
        <form class="form" action="{{route('user.index')}}">
            @csrf

            <div class="row justify-content-end ">
                    {{-- search for student by name --}}
                    <div class="col-sm-3">
                        <input class="form-control form-control" type="text"
                        placeholder="First Name" aria-label="first_name" name="first_name">
                    </div>

                    {{-- search for student by name --}}
                    <div class="col-sm-3">
                        <input class="form-control form-control" type="text"
                        placeholder="Last Name" aria-label="last_name" name="last_name">
                    </div>

                    {{-- search for student by email --}}
                    <div class="col-sm-3">
                        <input class="form-control form-control" type="text"
                        placeholder="Username" aria-label="username" name="username">
                    </div>

                    {{-- sort by role --}}
                    <div class="col-sm-2">
                        @dropdown([
                            'attribute'   => 'role',
                            'label'       => '',
                            'condition'   => 'All Roles',
                            'options'     => array_merge(['All Roles'], \App\Utilities\Role::getRolesAsStr()),
                        ])
                    </div>

                    <div class="col-sm-1">
                        <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                    </div>
            </div>
        </form>
    @endslot

    @slot('thead')
        @table_header([
            'headers' => [
                'First Name',
                'Last Name',
                'Username',
                'Phone Number',
                'Profile',
                'Information'
            ],
        ])
    @endslot

    @slot('tbody')
        @foreach($users as $user)
            <tr>
                <td>{{$user->first_name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->phone_number}}</td>
                <td>
                    @button([
                        'type'      => '',
                        'class'     => 'btn btn-primary',
                        'div_class' => '',
                        'href'      => route('profile.show', $user),
                        'text'      => 'Profile'
                    ])
                </td>
                <td>
                    @button([
                        'type'      => '',
                        'class'     => 'btn btn-secondary',
                        'div_class' => '',
                        'href'      => route('user.show', $user),
                        'text'      => 'Information'
                    ])
                </td>
            </tr>
        @endforeach
    @endslot
@endtable

{{-- this is pagination --}}
<div class="row justify-content-center">
    {{ $users->links() }}
</div>

@endsection

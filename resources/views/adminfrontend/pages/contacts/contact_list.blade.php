<?php
	use App\Models\Categories_Groups;
?>
@extends('adminfrontend.layouts.index')
@section('admincontent')
     <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 my-3 mb-md-0">
                <!--------------- Alert ------------------------>
                @include('adminfrontend.pages.alert')
                <!---------------End Alert ------------------------>
            </div>

            <!------------------------------------------------------------------------------------>
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap align-items-center justify-content-between align-items-baseline">
                        <div class="left">
                            <h4 class="text-medium mb-20 text-primary">Contacts List</h4>
                        </div>
                        <div class="right">
                            <a
                                class="btn btn-outline-primary shadow rounded-1 py-1"
                                href="{{url('/admin/contact-add')}}"
                                role="button">
                                <p class="text-sm">Add Contact</p>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table top-selling-table table-hover">
                            <thead>
                                <tr>
                                    <th><h6 class="text-sm text-medium">#</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Contact Info</h6></th>
                                    <th class="min-width text-center"><h6 class="text-sm text-medium">Date</h6></th>
                                    <th class="min-width text-center"><h6 class="text-sm text-medium">Actions</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td><p class="text-sm">{{$count++}}</p></td>
                                        <td><p class="text-sm">{{$contact->contact_info}}</p></td>
                                        <td><p class="text-sm text-center">{{$contact->created_at->diffForHumans()}}</p></td>
                                        <td class="text-center">
                                            <a
                                                class="btn btn-outline-success btn-sm py-1 px-2 rounded-0"
                                                href="{{url('admin/contact-edit/'.$contact->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Edit Details"
                                                >
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <a
                                                class="btn btn-outline-danger btn-sm py-1 px-2 rounded-0"
                                                href="{{url('admin/contact-delete/'.$contact->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delete from list"
                                                >
                                                <i class="bi bi-trash3-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
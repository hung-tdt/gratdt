@extends('admin.component.main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Customer List</h2>             
        </div>         
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label" for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label" for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label" for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control">
                    </div>
                </div>
                
                <button type="button" class="btn btn-primary" id="searchBtn"> <i class="fa fa-search"></i> Search</button>
                <button type="button" class="btn btn-w-m btn-default" id="resetBtn"> <i class="fa fa-refresh"></i> Reset</button>
            </div>
        </div>

                        
            <div class="ibox-content">
                <button style="margin-left: 0px;" type="button" class="btn btn btn-primary"> <i class="fa fa-plus"></i>
                    <a class="font-white" href="{{ route('customers.create') }}"> Create</a>
                </button>

                <table id="customerTable" class="tbf footable table table-stripped toggle-arrow-tiny default breakpoint footable-loaded" data-page-size="15">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
                            </th>
                            <th>Customer code</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Avatar</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Amount order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $key => $customer)
                        <tr>
                            <td>
                                <input type="checkbox" class="customer-checkbox" name="customers[]" value="{{ $customer->id }}">
                            </td>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->username }}</td>
                            @if($customer->thumb == null)
                            <td></td>
                            @else
                            <td>
                                <a href="{{ $customer->thumb }}" target="_blank">
                                    <img src="{{ $customer->thumb }}" height="30px">
                                </a>
                            </td>
                            @endif
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td style="text-align: center">{!! \App\Helpers\Helper::active($customer->active) !!}</td>
                            <td>{{ $customer->orders->count() }}</td>
                            <td>
                                <div class="button-row1">
                                    <a style="margin: 1px" class="btn btn-success dim" href="{{ route('customers.edit', ['id' => $customer->id]) }}">
                                        <i class="fa fa-edit (alias)"></i>
                                    </a>
                                    <a style="margin: 1px" class="btn btn-danger  dim" href="#" onclick="removeRow({{ $customer->id }}, '{{ route('customers.destroy', ['id' => $customer->id]) }}')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <form id="notificationForm" action="{{ route('notifications.send') }}" method="POST">
                    @csrf
                    <input type="hidden" name="message" id="notificationMessage">
                    <button type="button" class="btn btn-primary" onclick="sendNotification()">Send a notification</button>
                </form>
                
            </div>    
    </div>
@endsection()

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/admin/search/customer.js"></script>
<script>
    function toggleSelectAll(selectAllCheckbox) {
        const checkboxes = document.querySelectorAll('.customer-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    }
</script>

<script>
    function sendNotification() {
        const selectedCustomers = [];
        document.querySelectorAll('.customer-checkbox:checked').forEach(checkbox => {
            selectedCustomers.push(checkbox.value);
        });

        if (selectedCustomers.length === 0) {
            alert('Please select at least one customer!');
            return;
        }

        const message = prompt('Enter message content:');
        if (!message) {
            alert('You have not entered the message content.!');
            return;
        }

        document.getElementById('notificationMessage').value = message;

        const form = document.getElementById('notificationForm');
        selectedCustomers.forEach(customerId => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'customers[]';
            input.value = customerId;
            form.appendChild(input);
        });

        form.submit();
    }
</script>
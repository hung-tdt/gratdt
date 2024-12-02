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
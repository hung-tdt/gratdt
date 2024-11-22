<thead>
    <tr>
        <th width='120px'>Post code</th>
        <th>Title</th>
        <th>Category</th>
        <th>Author</th>
        <th>Image</th>
        <th>Active</th>
        <th>Created date</th>              
        <th width='120px'>Action</th>
    </tr>
</thead>
<tbody>
    @foreach($posts as $key => $post) 

    <tr>
        <td>{{ $post->id }}</td>                                    
        <td>{{ $post->title }}</td>
        <td>{{ $post->postCategory->name }}</td>
        <td>{{ $post->author }}</td>
        <td><a href="{{ $post->thumb }}" target="_blank">
            <img src="{{ $post->thumb }}" height="60px"></a>
        </td>
        <td style="text-align: center">{!! \App\Helpers\Helper::active($post->active) !!}</td>  
        <td>{{ $post->created_at }}</td>
        <td>                    
            <div class="button-row1">                       
                <a style="margin: 1px" class="btn btn-success dim" 
                    href="{{ route('posts.edit', ['post' => $post->id]) }}">
                    <i class="fa fa-edit (alias)"></i>
                </a>    
                <a style="margin: 1px" class="btn btn-danger  dim " href="#"
                    onclick="removeRow({{ $post->id }}, '{{ route('posts.destroy', ['post' => $post->id]) }}')">
                    <i class="fa fa-trash"></i>
                </a>
            </div>  
        </td>
    </tr>
    @endforeach               
</tbody>   
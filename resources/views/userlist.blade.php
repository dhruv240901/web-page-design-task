@foreach ($users as $k => $value)
<tr id="user{{$value->id}}">
    <input type="hidden" value="{{$value->id}}" id="user_id" name="user_id">
    <th scope="row">{{ $k + 1 }}</th>
    <td>{{ $value->firstname }}</td>
    <td>{{ $value->lastname }}</td>
    <td>{{ $value->email }}</td>
    <td>{{ $value->phone }}</td>
    <td>
        @auth
        @if($value->owner_id==auth()->id())
        <a href="javascript:void(0);" type="button" onclick="openeditmodal('{{$value->id}}','{{$value->firstname}}','{{$value->lastname}}','{{$value->email}}','{{$value->phone}}')" class="btn btn-success">
            <img src="{{ asset('images/edit.svg') }}" alt="">
        </a>
        <a href="javascript:void(0);" type="button" onclick="opendeletemodal('{{$value->id}}')" class="btn btn-danger">
            <img src="{{ asset('images/delete.svg') }}" alt="">
        </a>
        @endif
        @endauth
    </td>
</tr>
@endforeach

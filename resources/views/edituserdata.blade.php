@foreach ($otheruser as $k => $value)
<tr id="user{{$value->id}}">
    <input type="hidden" value="{{$value->id}}" id="user_id" name="user_id">
    <th scope="row">{{ $k + 1 }}</th>
    <td>{{ $value->firstname }}</td>
    <td>{{ $value->lastname }}</td>
    <td>{{ $value->email }}</td>
    <td>{{ $value->phone }}</td>
    <td>
        <a href="javascript:void(0);" type="button" onclick="openeditmodal('{{$value->id}}','{{$value->firstname}}','{{$value->lastname}}','{{$value->email}}','{{$value->phone}}')" class="btn btn-success" style="background-color:#1bcf1b">
            <img src="{{ asset('images/edit.svg') }}" alt="">
        </a>

        <form action="#"
            onsubmit="return confirm('Are you sure you want to delete this account?')"
            style="display: inline">
            <button type="submit" class="btn" style="background-color:red">
                <img src="{{ asset('images/delete.svg') }}" alt="">
            </button>
        </form>
    </td>
</tr>
@endforeach

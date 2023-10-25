<tr>
    <th scope="row">2</th>
    <td>{{$otheruser->firstname}}</td>
    <td>{{$otheruser->lastname}}</td>
    <td>{{$otheruser->email}}</td>
    <td>{{$otheruser->phone}}</td>
    <td>
        <a href="#" type="button" class="btn btn-success" style="background-color:#1bcf1b">
            <img src="{{ asset('images/edit.svg') }}" alt="">
        </a>

        <form action="#" onsubmit="return confirm('Are you sure you want to delete this account?')"
            style="display: inline">
            <button type="submit" class="btn" style="background-color:red">
                <img src="{{ asset('images/delete.svg') }}" alt="">
            </button>
        </form>
    </td>
</tr>

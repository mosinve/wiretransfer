<table>
    <tr>
        <th>
            Balance transfer confirmation needed
        </th>
    </tr>
    <tr>
        <td>
            <p>
                There is a balance transfer request of amount of <strong>{{$transaction->sum}}</strong> credits to
                <strong>{{$transaction->toUser->name}}</strong>.
            </p>
            <p>To approve this transfer, please follow this <a href="{{url('/approve', [$transaction->pincode])}}">link</a></p>
        </td>
    </tr>
</table>
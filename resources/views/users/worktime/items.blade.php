<tr>
    <td>{{ $worktime->date }}</td>
    <td>{{  $worktime->time_start }}</td>
    <td>{{  $worktime->time_finish }}</td>
    <td>{{  $worktime->total }}</td>
    <td>{{  $worktime->reduce }}</td>
    <td>{{  $worktime->teleworking }}</td>
    <td>{{  $worktime->description }}</td>
    <td>
        <a href="{{ route('user.worktime.edit',[$worktime->id])  }}"><i class="fa fa-edit"></i></a>
        <a href="{{ route('user.worktime.delete',[$worktime->id])  }}"><i class="fa fa-trash"></i></a>
    </td>
</tr>
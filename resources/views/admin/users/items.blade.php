<tr>
    <td>{{  $user->user_id  }}</td>
    <td><img class="user_image" src="{{  asset('user_image\\').$user->user_image  }}" alt=""></td>
    <td>{{  $user->fname }} {{ $user->lname }}</td>
    <td>{{  $user->code }}</td>
    <td>{{  $user->email }}</td>
    <td>{{  $user->phone_number }}</td>
    <td>{{  $user->date_employment }}</td>
    <td>{{  $user->branch_work }}</td>
    <td>

        <a href="{{ route('admin.user.edit',[$user->user_id])  }}"><i class="fa fa-edit"></i></a>
        <a href="{{ route('admin.user.delete',[$user->user_id])  }}"><i class="fa fa-trash"></i></a>
    </td>

</tr>
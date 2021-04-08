<tr>
    <td>{{  $leavement->leavement_id  }}</td>
    <?php
    $text='';
    if($leavement->leavement_type == 1){
        $text='روزانه';
    }
    ?>
    <td>{{ $text }}</td>
    <td>{{  $leavement->leavement_start }}</td>
    <td>{{  $leavement->leavement_finish }}</td>
    <td>{{  $leavement->leavement_date_count }}</td>
    <td>{{  $leavement->leavement_description }}</td>
    <?php
    $class='bg-warning';
    $text='در حال بررسی';
    if($leavement->leavement_status == 1){
        $class='bg-danger';
        $text='رد شده';
    }
    elseif($leavement->leavement_status == 2){
        $class='bg-success';
        $text='تایید شده';
    }
    ?>
    <td><span class="badge {{$class}}">{{  $text }}</span></td>
    <td>
        <a href="{{ route('user.leavement.edit',[$leavement->leavement_id])  }}"><i class="fa fa-edit"></i></a>
        <a href="{{ route('user.leavement.delete',[$leavement->leavement_id])  }}"><i class="fa fa-trash"></i></a>
    </td>

</tr>
<tr>
    <td>{{$leavement->user->fname}} {{$leavement->user->lname}}</td>
    <td>{{$leavement->user->phone_number}}</td>
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
        <a href="{{ route('admin.leavement.agree',[$leavement->leavement_id])  }}">قبول</a>
        <a href="{{ route('admin.leavement.disagree',[$leavement->leavement_id])  }}">رد</a>
    </td>

</tr>
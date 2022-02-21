<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <td width="10px" align="center" scope="col"><b>No</b></td>
      <td width="10px" align="center" scope="col"><b>ID</b></td>
      <td width="10px" align="center" scope="col"><b>Group</b></td>
      <td width="200px" align="center" scope="col"><b>Question</b></td>
      <td width="200px" align="center" scope="col"><b>A</b></td>
      <td width="200px" align="center" scope="col"><b>B</b></td>
      <td width="200px" align="center" scope="col"><b>C</b></td>
      <td width="200px" align="center" scope="col"><b>D</b></td>
      <td width="10px" align="center" scope="col"><b>Key</b></td>
      <td width="150px" align="center" scope="col"><b>Action</b></td>
    </tr>
  </thead>
  <tbody>
    @foreach ($mc_question as $mc)
    <tr>
      <td align="center">{{ $loop->iteration }}</th>
      <td align="center">{{ $mc->id }}</th>
      <td align="center">{{ $mc->question_group->group }}</td>
      <td align="left">{{ $mc->question }}</td>
      <td align="left">{{ $mc->a }}</td>
      <td align="left">{{ $mc->b }}</td>
      <td align="left">{{ $mc->c }}</td>
      <td align="left">{{ $mc->d }}</td>
      <td align="center">{{ $mc->key }}</td>
      <td align="center">
        <a href="{{ route('aplication_ratings.mc_questions.edit', [$aplication_rating, $mc]) }}" class="btn btn-success fas fa-edit"></a>
        <form action="{{ route('aplication_ratings.mc_questions.destroy', [$aplication_rating, $mc]) }}" method="post" class="d-inline">
          @method('delete')
          @csrf
        <button type="submit" class="btn btn-danger fas fa-trash" onclick="return confirm('Are you sure want to delete this data?')"> 
        </button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>


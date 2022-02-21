<table class="table table-striped table-bordered table-hover" id="table">
  <thead>
    <tr>
      <td width="20px" align="center" scope="col"><b>No</b></td>
      <td width="50px" align="center" scope="col"><b>License Number</b></td>
      <td width="200px" align="center" scope="col"><b>Name</b></td>
      <td width="100px" align="center" scope="col"><b>Action</b></td>
    </tr>
  </thead>
  <tbody>
  @foreach ($user as $user)
    <tr>
      <td align="center">{{ $loop->iteration }}</th>
      <td align="center">{{ $user->id }}</td>
      <td align="left">{{ $user->name }}</td>
      <td align="center">
        <form action="/completeness_files/{{ $user->id }}/index" method="post" class="d-inline">
          @csrf
        <button type="submit" class="btn btn-primary fas fa-eye">
        </button>
        </form>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

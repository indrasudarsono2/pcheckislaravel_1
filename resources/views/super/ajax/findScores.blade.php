<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <td width="10px" align="center" scope="col"><b>No</b></td>
      <td width="200px" align="center" scope="col"><b>License Number</b></td>
      <td width="200px" align="center" scope="col"><b>Name</b></td>
      <td width="200px" align="center" scope="col"><b>Action</b></td>
    </tr>
  </thead>
  <tbody>
    @foreach ($user as $user)
    <tr>
      <td align="center">{{ $loop->iteration }}</th>
      <td align="center">{{ $user->id }}</td>
      <td align="left">{{ $user->name}}</td>
      <td align="center">
        <a href="{{ route('user.session.user_sesion', $user) }}" class="btn btn-info fas fa-lock-open"> Open</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
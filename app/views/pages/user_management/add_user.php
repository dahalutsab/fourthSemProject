

<h1>Add User</h1>
<form action="/api/user/create-user" method="POST">
    <div class="form-group
    ">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>

    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select class="form-control" id="role" name="role" required>
            <option value="USER">User</option>
            <option value="ARTIST">Artist</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

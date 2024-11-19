


<form action="create-role" method="POST">
    @csrf
    @method('POST')
    Nome Role : <input type="text" id="role_name" name="role_name"/>
<fieldset>
    <legend>Permissions</legend>
    @foreach ($permissions as $permission)
    <div>
        <input type="checkbox" id="{{ $permission }}" name="permissions[]" value="{{ $permission }}" />
        <label for="scales">{{ $permission }}</label>
    </div>
    @endforeach

</fieldset>

    <fieldset>
        <legend>Roles</legend>
        @foreach ($roles as $role)
            <div>
                <input type="checkbox" id="roles" name="roles[]" value="{{ $role }}" />
                <label for="scales"> {{ $role }}</label>
            </div>
        @endforeach

    </fieldset>

    <fieldset>
        <legend>Users w/out Permission</legend>
        @foreach ($users as $user)
            <?php //dd($user); ?>
            <div>
                <input type="checkbox" id="roles" name="users[]" value="{{ $user[0] }}" />
                <label for="scales"> {{ $user[1] }}</label>
            </div>
        @endforeach

    </fieldset>

    <input type="submit" value="Salvar">


</form>



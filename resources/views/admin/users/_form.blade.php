<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::text('name', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    {!! Form::label('email', 'Email', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::text('email', null, ['class' => 'form-control', 'required']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
    {!! Form::label('type_id', 'User Type', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        <select name="type_id" class="form-control">
            @foreach ($usertypes as $usertype)
                <option value="{{ $usertype->id }}" {{ ($usertype->id == $user->type_id ? 'selected' : '') }}>{{ $usertype->type }}</option>
            @endforeach
        </select>

        <span class="help-block">
            <strong>{{ $errors->first('type_id') }}</strong>
        </span>
    </div>
</div>

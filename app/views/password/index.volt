{{ flash.output() }}
{{ content() }}
{% set auth = session.get('auth') %}

<div class="page-header">
    <h2>Регистрация</h2>
</div>

<div class="container">

    {{ form('/change_password') }}
    <fieldset>
        <div class="control-group">
            {{ form.label('old_password',  ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('old_password', ['class': 'form-control']) }}
            </div>
        </div>

        <div class="control-group">
            {{ form.label('new_password',  ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('new_password', ['class': 'form-control']) }}
            </div>
        </div>

        <div class="control-group">
            {{ form.label('repeatPassword',  ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('repeatPassword', ['class': 'form-control']) }}
            </div>
        </div>
        <br/>

        <div class="form-actions">
            {{ submit_button('Изменить', 'class': 'btn btn-primary') }}
        </div>
    </fieldset>
    <input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}">
    <input type="hidden" name="id" value="{{ auth['id'] }}">
    </form>
</div>
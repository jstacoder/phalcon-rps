{% extends 'base.volt' %}

{% block content %}
    {{ flash }}
    <div class=row>
    <div class=col-md-6>
        <h2 class=page-header>Pick Your player</h2>
        {{ form('pick',{'method':'post'}) }}
            <div class=form-group>
                {{ form.label('user') }}
                {{ form.render('user') }} 
            </div>
            <button type=submit class="btn btn-primary">Play</button>
        </form>
    </div>
    <div class=col-md-6>
        <h2 class=page-header>Add new Player</h2>
        {{ form('add',{'method':'post'}) }}
            <div class=form-group>
                {{ addform.label('name') }}
                {{ addform.render('name') }}
            </div>
        <button type=submit class="btn btn-success">Add</button>
        </form>
    </div>
    </div>
{% endblock %}

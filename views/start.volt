{% extends 'base.volt' %}

{% block content %}
    <h2 class=page-header>Pick Your player</h2>
    {{ form('pick',{'method':'post'}) }}
        <div class=form-group>
            {{ form.label('user') }}
            {{ form.render('user') }} 
        </div>
        <button type=submit class="btn btn-primary">Play</button>
    </form>
{% endblock %}

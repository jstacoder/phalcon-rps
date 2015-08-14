{% extends 'base.volt' %}
{% block content %}
{% macro render_score_type(type,score) %}
    <li style="font-size:1.2em;" class="text-center">{{ type }}: {{ score }}</li>
    {% if not loop.last %}
        <hr />
    {% endif %}
{% endmacro %}
{% macro render_score(score) %}
    <div class="panel panel-default col-md-2 col-md-offset-1">
        <ul class="list-unstyled top-list">
            <li class=text-center style="font-size:1.3em;">
                Date: {{ score['date'] }}
            </li>
            <hr />
                {% for t in ['wins','losses','ties'] %}
                        {{ render_score_type(t,score[t]) }}
                {% endfor %}
        </ul>
    </div>
{% endmacro %}
        {{ scores }}
        <div class=col-md-12>
            <div class=row>
        {% for s in scores %}
            {{ render_score(s) }}
        {% endfor %}
            </div>
        </div>
    {% endblock %}

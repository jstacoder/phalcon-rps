{% extends 'play-game.volt' %}

    {% block content %}
        {% if user %}
            <style>
                .list-group-item {
                    cursor:pointer;
                }
            </style>
            <h2>Current player {{ user }}</h2>
            <p class=lead>Pick One</p>
            <div class=row>
                <div class=col-md-4>
                    <div class=list-group>
                        <a href="/play/rock" class=list-group-item><p class=text-center>rock</p></a>
                    </div>
                </div>
                <div class=col-md-4>
                    <div class=list-group>
                        <a href="/play/paper" class=list-group-item><p class=text-center>paper</p></a>
                    </div>
                </div>
                <div class=col-md-4>
                    <div class=list-group>
                        <a href="/play/scissors" class=list-group-item><p class=text-center>scissors</p></a>
                    </div>
                </div>
            </div>
        {% endif %}
    {% endblock %}
    {% block after_content %}
        <form action="/save" method="post">
            <button type=submit class="btn btn-primary">save</button>
        </form>
    {% endblock %}


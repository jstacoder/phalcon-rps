{% extends "play-game.volt" %}

    {% block content %}
        <div>
            <p class=lead>{{ user }}</p>
            <p>Wins: {{ wins }}</p>
            <p>Losses: {{ losses }}</p>
            <p>Ties: {{ ties }}</p>
        </div>
        <button href="/start" class="btn btn-primary btn-lg">play again</button>
        <a class="btn btn-default" href="/scores/{{ user_id }}">view Scores</a>
    {% endblock %}

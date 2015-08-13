{% extends "play-game.volt" %}

    {% block content %}
        <div>
            <p>Wins: {{ score.wins }}</p>
            <p>Losses: {{ score.losses }}</p>
            <p>Ties: {{ score.ties }}</p>
        </div>
        <button class="btn btn-primary btn-lg">play again</button>
    {% endblock %}

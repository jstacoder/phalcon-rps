from sqlalchemy.ext.declarative import declarative_base, declared_attr
import sqlalchemy as sa
import inflection as i

URI = 'mysql://rps:rps@localhost:3306/rps'

class Base(declarative_base(bind=sa.create_engine(URI,echo=True))):
    __abstract__ = True
    @declared_attr
    def __tablename__(self,name=None):
        return name or i.pluralize(i.underscore(self.__name__))

    @declared_attr
    def id(self):
        return sa.Column(sa.Integer,primary_key=True)


class User(Base):
    name = sa.Column(sa.String(255),nullable=False)
    played_games = sa.orm.relation('PlayedGame',secondary='played_games_users')
    password = sa.Column(sa.Text,nullable=False)

class PlayedGame(Base):
    date = sa.Column(sa.DateTime,default=sa.func.now(),server_default=sa.func.now())
    users = sa.orm.relation(User,secondary='played_games_users')
    scores = sa.orm.relation('Score')

class Score(Base):
    user_id = sa.Column(sa.Integer,sa.ForeignKey('users.id'))
    user = sa.orm.relation(User,uselist=False)
    value = sa.Column(sa.String(255),nullable=False)
    played_game_id = sa.Column(sa.Integer,sa.ForeignKey('played_games.id'))
    played_game = sa.orm.relation(PlayedGame,uselist=False)

played_games_users =  sa.Table('played_games_users',Base.metadata,
        sa.Column('users_id',sa.Integer,sa.ForeignKey('users.id')),
        sa.Column('played_games_id',sa.Integer,sa.ForeignKey('played_games.id'))
)


Base.metadata.create_all(checkfirst=True)




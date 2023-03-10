import app from 'flarum/forum/app';

app.initializers.add('finteger/guest', () => {
  console.log('[finteger/guest] Hello, forum!');
});

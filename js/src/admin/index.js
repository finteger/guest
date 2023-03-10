import app from 'flarum/admin/app';

app.initializers.add('finteger/guest', () => {
  console.log('[finteger/guest] Hello, admin!');
});

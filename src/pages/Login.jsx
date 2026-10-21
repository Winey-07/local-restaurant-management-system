import { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

export default function Login() {
  const { signIn } = useAuth();
  const navigate = useNavigate();
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const [busy, setBusy] = useState(false);

  async function submit(e) {
    e.preventDefault(); setError(''); setBusy(true);
    try {
      await signIn({ email, password });
      navigate('/dashboard', { replace: true });
    } catch (err) {
      setError(err.response?.data?.errors?.email?.[0] ||
err.response?.data?.message || 'Unable to log in');
    } finally { setBusy(false); }
  }
  return <form onSubmit={submit}>
    <h1>Login</h1>
    {error && <p role="alert">{error}</p>}
    <input aria-label="Email" type="email" required value={email}
      onChange={e => setEmail(e.target.value)} />
    <input aria-label="Password" type="password" required value={password}
      onChange={e => setPassword(e.target.value)} />
    <button disabled={busy}>{busy ? 'Logging in...' : 'Login'}</button>
    <Link to="/register">Create an account</Link>
  </form>;
}

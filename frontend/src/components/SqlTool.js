import React, { useState } from 'react';
import api from '../api';

export default function SqlTool() {
  const [query, setQuery] = useState('');
  const [results, setResults] = useState([]);

  const runQuery = () => {
    api.post('/sql', { query })
      .then(res => setResults(res.data))
      .catch(err => alert("Error executing SQL"));
  };

  return (
    <div>
      <h2>SQL Tool</h2>
      <textarea rows={6} cols={60} value={query} onChange={e => setQuery(e.target.value)} />
      <br />
      <button onClick={runQuery}>Run</button>
      <pre>{JSON.stringify(results, null, 2)}</pre>
    </div>
  );
}
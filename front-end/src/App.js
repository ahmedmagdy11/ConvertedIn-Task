import './App.css';
import Leaderboard from './components/leaderboard';
import TaskForm from './components/TaskForm';
import { BrowserRouter, Route, Routes, } from "react-router-dom";

function App() {
  return (
    <div className="App">
      <header className="App-header">
        <BrowserRouter>
          <Routes>
            <Route path="/" element={<TaskForm />} />
            <Route path='/leadboard' element={<Leaderboard />} />
          </Routes>
        </BrowserRouter>

      </header>
    </div >
  );
}

export default App;

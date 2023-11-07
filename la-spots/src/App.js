import logo from './logo.svg';
import './App.css';
import Home from './Components/Home';
import Navbar from './Components/Navbar';
import Search from './Components/Search';
import { BrowserRouter, Routes, Route, Outlet, Navigate, Link} from "react-router-dom";

function Template(){
  return(
    <div>
      <Navbar></Navbar>
    </div>
  );
}
function App() {
  return (
      <BrowserRouter>
          <Routes>
              <Route path="/" element={<Template></Template>}>
                  <Route index element={<Home></Home>} />
                  <Route path={'/search'} element={<Search></Search>} />
              </Route>

          </Routes>
      </BrowserRouter>
  );
}

export default App;

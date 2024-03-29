import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import LoginPage from './components/loginContainer/LoginPage';
import RegisterPage from './components/registrContainer/RegisterPage';
import Header from './components/Header';
import MainPage from './components/MainPageContainer/MainPage';

function App() {
    const serverPort = 7777;
    return(
        <Router>
            <Header title="Coordinate checker"/>
            <Routes>
                {/* <Route path='/' element={<Body/>}/> */}
                <Route path='/' element={<LoginPage serverPort={serverPort}/>}/>
                <Route path='/register' element={<RegisterPage serverPort={serverPort}/>}/>
                <Route path='/main' element={<MainPage serverPort={serverPort}/>}/>
            </Routes>
        </Router>
    )
}

export default App;

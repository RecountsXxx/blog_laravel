import logo from './logo.svg';
import './App.css';
import { io } from 'socket.io-client';

import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';


function App() {

  // Объект соединения с сокет сервером
  let socket = io('/', {
    autoConnect: true
  });


  // Поведение при событии - соединился
  socket.on('connect', (data) => {
    console.log('connect')
  })

  socket.on('disconnect', (data) => {
    console.log('disconnect')
    console.log(data)
    toast.error('Disconnect')
  })

  // Поведение при сообщении socket.myNameIs
  socket.on ('socket.myNameIs', (data) => {
    console.log('MyName Is')
    console.log(data)
    toast.info("Server name: " + data);
  })

  // Поведение при сообщении socket.myNameIs
  socket.on ('socket.ping', (data) => {
    toast.dark("Ping: " + Date(data));
  })

  socket.on ('socket.php', (data) => {
    toast.warning("From Laravel: " + data);
  })



  console.log('App Starting')

  return (
    <div className="App">
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <p>
          Hello World !!!
        </p>
        <a
          className="App-link"
          href="https://reactjs.org"
          target="_blank"
          rel="noopener noreferrer"
        >
          Learn React
        </a>
      </header>
      <ToastContainer />
    </div>
  );
}

export default App;

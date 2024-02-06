import './App.css';
import { io } from 'socket.io-client';

import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

import NavMenu from "./layouts/nav-menu";

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
        <div className="container-fluid vh-100">
          <div className=" row h-100">
            <div className="p-0 col-md-2 text-white nav_menu"> {/* Боковой хеадер */}
             <NavMenu></NavMenu>
            </div>
            <div className="col-md-5 bg-secondary"> {/* Средняя часть слева */}
              Средняя часть слева
            </div>
            <div className="col-md-5 bg-black"> {/* Средняя часть справа */}
              Средняя часть справа
            </div>
          </div>
        </div>
      </div>
  );
}

export default App;

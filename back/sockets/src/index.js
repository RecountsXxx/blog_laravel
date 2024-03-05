/**
 * Configure Redis server
 */
const REDIS_SOCKET_HOST = process.env.REDIS_SOCKET_HOST || 'redis.sockets';
const REDIS_SOCKET_PORT = process.env.REDIS_SOCKET_PORT || 6379;
const REDIS_SOCKET_CONNECTION_STRING = `redis://${REDIS_SOCKET_HOST}:${REDIS_SOCKET_PORT}`;

/**
 * Configure microservice
 */
const SERVER_NAME = process.env.SERVER_NAME || 'Node Socket';
const SERVER_PORT = process.env.SERVER_PORT || 3000;

/**
 * Import modules
 */
import express from 'express'; // Импортируем express
import { Server } from 'socket.io';
import { createClient } from 'redis';
import { createAdapter } from '@socket.io/redis-adapter';
import cors from 'cors'; // Импортируем CORS middleware

/**
 * Create redis
 */
const pubClient =  createClient({
    url: REDIS_SOCKET_CONNECTION_STRING});
const subClient =  pubClient.duplicate();

pubClient.on('connect', () => {
    console.debug('Pub connection to Redis server ok');
});
subClient.on('connect', () => {
    console.debug('Sub connection to Redis server ok');
});

/**
 * Create express app
 */
const app = express(); // Создаем express приложение
app.use(cors()); // Применяем CORS middleware

/**
 * Create socket server
 */
const server = app.listen(SERVER_PORT, () => {
    console.log(`Server is running on port ${SERVER_PORT}`);
});

const io = new Server(server);

Promise.all([pubClient.connect(), subClient.connect()]).then(() => {

    io.adapter(createAdapter(pubClient, subClient));

    io.on('connection', (socket) => {
        socket.emit('socket.myNameIs', SERVER_NAME);
        console.debug('connection: ' + socket.handshake.address);

        socket.on('disconnect', data => {
            console.debug('disconnect: ' + socket.handshake.address);
        })
        socket.on('socket.message.admin', (message) => {
            io.emit('socket.message.admin', message);
        });
    })
    setInterval(() =>{
        io.emit('socket.ping', Date.now())
    }, 10000)

});

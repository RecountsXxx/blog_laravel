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
import { Server } from 'socket.io';
import { createClient } from 'redis';
import { createAdapter } from '@socket.io/redis-adapter';

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
 * Create socket server
 */
const io = new Server();


Promise.all([pubClient.connect(), subClient.connect()]).then(() => {

    io.adapter(createAdapter(pubClient, subClient));

    io.on('connection', (socket) => {
        socket.emit('socket.myNameIs', SERVER_NAME);
        console.debug('connection: ' + socket.handshake.address);

        socket.on('disconnect', data => {
            console.debug('disconnect: ' + socket.handshake.address);
        })
    })

    io.listen(SERVER_PORT);

// Пинг сервера - для всех (пустое бессмысленное сообщение)
    setInterval(() =>{
        io.emit('socket.ping', Date.now())
    }, 10000)

});
import socket

client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
#host, port = "127.0.0.1", 9000
client_socket.connect(("127.0.0.1", 9001))
nom = input("Quelle est votre nom ? ")

if __name__ == "__main__":

    while True:

        message = input(f"{nom} > ")
        client_socket.send(f"{nom} > {message}".encode("utf-8"))
        
        
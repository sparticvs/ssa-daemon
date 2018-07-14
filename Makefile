CC = gcc
CXXFLAGS=-Wall -Wno-deprecated-declarations
CXX_DEBUG_FLAGS=-g
CXX_RELEASE_FLAGS=-O3 -DNO_LOG
CXX_CLIENTAUTH_FLAGS= -g -DCLIENT_AUTH
CXX_ZERORTT_FLAGS= -g -DZERO_RTT
 
EXEC = tls_wrapper
SOURCES = $(wildcard *.c)
OBJECTS = $(SOURCES:.c=.o)
STD_INCLUDES = -I/usr/include/libnl3
NEW_INCLUDES = \
	-I /usr/include/libnl3 \
	-I openssl/include \
	-I libevent/include
LIBS = 	-lnl-3 \
	-lnl-genl-3 \
	-levent_openssl \
	-levent -lcrypto \
	-lssl \
	-lconfig \
	-lavahi-client \
	-lavahi-common \
	-lpthread
LIBS_EX = \
	-L openssl/lib \
	-L libevent/lib \
	-lnl-3 -lnl-genl-3 \
	-levent_openssl \
	-levent \
	-lcrypto \
	-lssl \
	-lconfig \
	-lavahi-client \
	-lavahi-common \
	-lpthread \
	-Wl,-rpath \
	-Wl,libevent/lib \
	-Wl,-rpath \
	-Wl,openssl/lib \
	`pkg-config --libs libnotify`
  
INCLUDES= \
	`pkg-config --cflags libnotify`

.PHONY: clean qrwindow run

all: CXXFLAGS+=$(CXX_DEBUG_FLAGS)
all: INCLUDES=$(STD_INCLUDES)
all: $(EXEC)

release: CXXFLAGS+=$(CXX_RELEASE_FLAGS)
release: INCLUDES+=$(STD_INCLUDES)
release: $(EXEC)

clientauth: CXXFLAGS+=$(CXX_CLIENTAUTH_FLAGS)
clientauth: INCLUDES+=$(NEW_INCLUDES)
clientauth: qrwindow
clientauth: $(OBJECTS)
	$(CC) $(OBJECTS) -o $(EXEC) $(LIBS_EX)

zerortt: CXXFLAGS+=$(CXX_ZERORTT_FLAGS)
zerortt: INCLUDES+=$(NEW_INCLUDES)
zerortt: qrwindow
zerortt: $(OBJECTS)
	$(CC) $(OBJECTS) -o $(EXEC) $(LIBS_EX)

# Main target
$(EXEC): $(OBJECTS)
	$(CC) $(OBJECTS) -o $(EXEC) $(LIBS)
 
# To obtain object files
%.o: %.c
	$(CC) -c $(CXXFLAGS) $< $(INCLUDES) -o $@
 
# To remove generated files
clean:
	rm -f $(EXEC) $(OBJECTS)
	$(MAKE) -C ./qrdisplay clean

qrwindow:
	$(MAKE) -C ./qrdisplay


SUBSCRIBERS_DIR = subscribers
CACHED_DATA_DIR = cached_data

all:
	# set writable
	test -d $(SUBSCRIBERS_DIR) || mkdir -p $(SUBSCRIBERS_DIR) && chmod 777 $(SUBSCRIBERS_DIR)
	test -d $(CACHED_DATA_DIR) || mkdir -p $(CACHED_DATA_DIR) && chmod 777 $(CACHED_DATA_DIR)

clean:
	rm -f ./cached_data/* ./subscribers/*

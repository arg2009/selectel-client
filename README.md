# A client to interface with the Selectel Cloud provider

Selectel: [https://selectel.ru/en/](https://selectel.ru/en/)

Note: This client is just to satisfy my requirements. It is by no means a complete CLI to the entire Selectel API.

## What it can do

- Login
- Logout
- Download the kubectl config from a cluster

## How to use it

See the file `example/download_kubectl_config.php`

1. Create an External Panel User
2. Grant it access to your Project containing your Kubernetes cluster
3. Take note of the username, password, external panel cnam and kubernetes ID

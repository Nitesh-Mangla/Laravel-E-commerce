<form class="w3-container" action="{{url('email')}}" method="POST"
            role="email">
            {{ csrf_field() }}
            <p>
                <label>Enter Some Text</label>
                <textarea class="w3-input" type="text" name="message"></textarea>
            </p>
            <p>
                <label>Email</label> <input class="w3-input" type="email"> <input
                    type="submit" name="toEmail" class="w3-btn w3-orange" value="Send">
            </p>
        </form>